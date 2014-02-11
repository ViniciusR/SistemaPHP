<?php

abstract class View
{
	public function saida($view)
	{
		//echo file_get_contents($view);
		header('Location: '.$view);
	}
}