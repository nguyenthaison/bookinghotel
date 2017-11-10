<?php
	
	namespace App\Http\Composers;

	use Illuminate\Contracts\View\View;
	use App\Area;

	class NavigationComposer
	{
		
		protected $areas = [];

		public function __construct()
		{
			$this->areas = Area::orderBy('title')->get(['id', 'title', 'slug']);
		}

		public function compose(View $view)
		{
			$view->with('areas', $this->areas);
		}
	}