<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\VarDumper\VarDumper;

class CubeController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		return view('cube/index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
//		echo "toma";

		return view('cube/create');
	}

	private function updateCube($x, $y, $z, $w) {
	}

	private function queryCube($x1, $y1, $z1, $x2, $y2, $z2) {

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$this->validate($request, [
			'valuex'        => 'required|integer|min:1|max:5',
			'valuey'        => 'required|integer|min:1|max:5',
			'operationsqty' => 'required|integer|min:1|max:5',
		]);

		$cube_settings = $request->all();
		unset($cube_settings['_token']);

		$request->session()->put('cube_settings', $cube_settings);

		$x_axis = $request->session()->get('cube_settings.valuex');
		$y_axis = $z_axis = $request->session()->get('cube_settings.valuey');

		$cube = array_fill(0, $x_axis, array_fill(0, $y_axis, array_fill(0, $z_axis, 0)));

		if ($request->session()->exists('cube')) {
			$request->session()->remove('cube');
		}

		$request->session()->put('cube', $cube);

		return view('cube/edit', ['repeat' => $request->session()->get('cube_settings.operationsqty')]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
		echo "show";
		exit;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		return view('cube/edit', ['repeat' => 2]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id = null) {
		$query_type = $request->get('query_type');

		foreach ($request->get('query_string') as $key => $query_string) {

			if ($query_type[ $key ] == 'UPDATE') {

				$split           = str_split($query_string);
				$slice_for_value = array_slice($split, 3);
				$update_value    = implode('', $slice_for_value);
				$cube            = $request->session()->get('cube');

				$x = ($split[0] - 1);
				$y = ($split[1] - 1);
				$z = ($split[2] - 1);

				$cube[ $x ][ $y ][ $z ] = $update_value;

				$request->session()->put('cube', $cube);

			} elseif ($query_type[ $key ] == 'QUERY') {

				//Divido el arreglo en dos parte para establecer rangos desde y hasta
				$split  = str_split($query_string);
				$chunks = array_chunk($split, (count($split) / 2));
				$from   = isset($chunks[0]) ? $chunks[0] : [];
				$to     = isset($chunks[1]) ? $chunks[1] : [];


				if ( ! isset($from[0]) || ! isset($from[1]) || ! isset($from[2]) || ! isset($to[0]) || ! isset($to[1]) || ! isset($to[2])) {
					throw new BadRequestHttpException('Los valores de entrada no tienen el formato correcto');
				} else {
					// A cada eje se le resta 1 para coincidir con los índices del json
					$from_axis_x = ($from[0] - 1);
					$from_axis_y = ($from[1] - 1);
					$from_axis_z = ($from[2] - 1);
					// A cada eje se le resta 1 para coincidir con los índices del json
					$to_axis_x = ($to[0] - 1);
					$to_axis_y = ($to[1] - 1);
					$to_axis_z = ($to[2] - 1);

					$data      = $request->session()->get('cube');
					$total_sum = 0;


					// Desde el valor indicado al eje x hasta el valor indicado al eje x
					for ($x = $from_axis_x; $x <= $to_axis_x; $x ++) {
						// Desde el valor indicado al eje y hasta el valor indicado al eje y
						for ($y = $from_axis_y; $y <= $to_axis_y; $y ++) {
							// Desde el valor indicado al eje z hasta el valor indicado al eje z
							for ($z = $from_axis_z; $z <= $to_axis_z; $z ++) {
								//Se suma el valor del índice al total
								$total_sum += isset($data[ $x ][ $y ][ $z ]) ? $data[ $x ][ $y ][ $z ] : 0;
							}
						}
					}

					VarDumper::dump($total_sum);

					// return $total_sum;
				}
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
