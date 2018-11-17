<?php 

namespace App\Http\Responsables;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

abstract class BaseResponse implements Responsable
{
	protected $view;

	abstract protected function prepare() : array ;

	public function toResponse($request)
	{
		$data = $this->prepare();

		if($request->isJson()) {
			return response()->json($data);
		} else {
			return response()->view($this->view, $data);
		}
	}

}