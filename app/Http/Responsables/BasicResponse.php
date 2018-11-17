<?php 

namespace App\Http\Responsables;

use App\Http\Responsables\BaseResponse;

class BasicResponse extends BaseResponse
{
	public function __construct($view = null, $args)
	{
		$this->data = $args;
		$this->view = $view;
	}

	protected function prepare() : array
	{
		return array_merge($this->data);
	}
}


