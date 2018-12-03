@extends('landing.master')

@section('body-class', 'bg-yellow')

@section('full-content')
	<main>
		<div class="pointer-events-none absolute h-full overflow-hidden pin-t w-full z-0">
			<div id="triangle-homepage">
		    	<svg width="1554" height="972" viewBox="0 0 1254 972" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M0 972L627 0L705.728 122.047L153.762 972H0ZM337.401 972H502.076L879.3 391.125L797.239 263.911L337.401 972ZM850.389 972H685.715L970.811 532.99L1052.87 660.204L850.389 972ZM1034.03 972H1254L1144.38 802.068L1034.03 972Z" fill="#FFD600"/>
				</svg>
		    </div>
		</div>
		<div>
			<div class="container mx-auto md:px-0 px-6">
				<div class="text-blue z-10">
				    <h1 class="mb-4 text-5xl">Giv din virksomhed<br/> en digital stemme</h1>
				    <p class="font-semibold leading-normal">
				        Opret en synlig & brugervenlig hjemmeside på under<br> 
				        5 minutter! <i>Ingen teknisk viden påkrævet.</i> 
				    </p>
				    <a class="btn my-12" href="{{ route('build.overview') }}">Byg din side</a>
			    </div>
			</div>
		</div>
	</main>
@endsection