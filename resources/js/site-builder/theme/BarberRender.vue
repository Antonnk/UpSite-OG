<template>
	<main class="h-screen font-sans">
		<header>
			<cl-image 
				class="bg-cover bg-no-repeat flex flex-col justify-between min-h-screen"
				:public-id="content.intro_image" 
				:options="{ crop: 'fill', width: 1000, height: 600, effect: 'colorize:70', color: '#1b1613' }">
				<div class="flex flex-col flex-1 items-center justify-center px-6">
					<h1 class="text-center text-orange text-6xl max-w-full break-words" v-text="content.name"></h1>
					<h2 class="font-light text-2xl text-center text-orange word-break max-w-xs" v-text="content.title"></h2>
				</div>
				<div class="flex flex-col md:flex-row py-8 px-6 quick-info-container">
					<div class="text-center p-4 w-full md:w-1/3">
						<h2 class="text-orange">Adresse</h2>
						<address class="text-white font-semibold">
							{{ content.contact.address.street }}<br>
							{{ content.contact.address.postcode +' '+ content.contact.address.city }}
						</address>
					</div>
					<div class="text-center p-4 w-full md:w-1/3">
						<h2 class="text-orange">Telefon</h2>
						<span class="text-white font-semibold" v-html="content.contact.phone"></span>
					</div>
					<div class="text-center p-4 w-full md:w-1/3">
						<h2 class="text-orange">Åbningstider</h2>
						<fetch-openhours>
							<b class="text-white mb-2" slot-scope="{ today, nextOpenDay }">
								<span v-if="today.openNow">
									Idag åben til {{ today.close }}
								</span>
								<span v-else-if="nextOpenDay">
									{{nextOpenDay.name}} åben <b>{{ nextOpenDay.open }} - {{ nextOpenDay.close }}</b>
								</span>
								<span v-else>
									Lukket
								</span>
							</b>
						</fetch-openhours>
					</div>
				</div>
			</cl-image>
		</header>
		<section class="flex-col md:flex-row flex">
			<div class="md:w-2/5 h-48 md:h-auto flex">
				<cl-image
					alt="grafik element"
					class="w-full h-full object-cover"
					:public-id="content.menu_image" 
					:options="{ crop: 'fill', width: 600, height: 600 }"
				/>
			</div>
			<div class="md:w-3/5 flex flex-col justify-center p-8 md:p-16">
				<h2 class="mb-5 text-5xl break-words" v-html="content.intro_title"></h2>
				<p v-html="content.intro" class="break-words"></p>
			</div>
		</section>

		<section class="bg-orange-lightest px-6">
			<div class="container mx-auto">
				<div class="flex justify-center py-20">
					<div class="container">
						<h2 class="text-5xl mb-6 text-center" v-text="content.menu_title"></h2>
						<ul class="list-reset">
							<li class="border-b border-orange flex mb-3 py-3" v-for="item in content.menu">
								<p class="flex-1 text-lg" v-text="item.name"></p>
								<p class="text-right text-lg font-bold">
									<span v-text="item.price"></span>
									<span>kr</span>
								</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section class="bg-black flex-1 py-16 px-6 text-white">
			<div class="container mx-auto">
				<div class="flex items-center mb-4 text-lg">
					<svg class="fill-current text-orange mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/></svg>
					<span v-text="content.contact.email"></span>
				</div>
				<div class="flex items-center mb-4 text-lg">
					<svg class="fill-current text-orange mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
					<span v-text="content.social.facebook"></span>
				</div>
				<div class="flex items-center mb-4 text-lg">
					<svg class="fill-current text-orange mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
					<span v-text="content.social.instagram"></span>
				</div>
			</div>
		</section>
	</main>
</template>

<script>
	import store from '../../store';

	export default {
		props: {
			value: {
				type: Object,
				default: () => store.getters.content
			}
		},
		data: vm => ({
			content: vm.value
		}),
	}
</script>