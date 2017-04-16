<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
		//
//		VarDumper::dump($request->all());
		$this->validate($request, [
			'valuex'        => 'required|integer|min:1|max:5',
			'valuey'        => 'required|integer|min:1|max:5',
			'operationsqty' => 'required|integer|min:1|max:5',
		]);

		$cube_settings = $request->all();
		unset($cube_settings['_token']);
		$request->session()->put('cube_settings', $cube_settings);
//		VarDumper::dump($request->session()->get('cube_settings'));

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
		return view('cube/edit');
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
		//
		VarDumper::dump($request->all());
		$cube = array();
//		$request->session()->put('key', 'value');
		$cube[$request->input('updatex')][$request->input('updatey')][$request->input('updatez')] = $request->input('updatew');
		VarDumper::dump($cube);
//		VarDumper::dump([$w,$x,$y,$w]);
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
