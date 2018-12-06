<template>
	<main class="bg-brown-lighter h-screen flex flex-col">
		<header class="container px-6 mx-auto flex py-6 items-baseline justify-between flex-no-shrink">
			<div class="flex-1">
				<a :href="'https://www.facebook.com/'+content.social.facebook" target="_blank">
					<svg class="fill-current text-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
				</a>			
				<a :href="'https://www.instagram.com/'+content.social.instagram" target="_blank">
					<svg class="fill-current text-green" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
				</a>
			</div>			
			<fetch-openhours>
				<span class="flex-1 text-right text-green" slot-scope="{ today, nextOpenDay }">
					<span v-if="today.openNow">
						Idag åben til <b>{{ today.close }}</b>
					</span>
					<span v-else-if="nextOpenDay">
						{{nextOpenDay.name}} åben <b>{{ nextOpenDay.open }} - {{ nextOpenDay.close }}</b>
					</span>
				</span>
			</fetch-openhours>
		</header>
		<section class="container px-6 flex flex-col flex-no-shrink items-start mx-auto py-4 md:flex-row">
			<div class="pr-0 w-full mb-10 md:w-1/2 md:pr-3">
				<h1 class="flex-1 text-green text-4xl">
					<editor :options="{disableReturn: true}" v-model="content.name" />
				</h1>
				<br>
				<br>
				<h2 class="text-brown mb-1">
					<editor v-model="content.title" />
				</h2>
				<p>
					<editor v-model="content.intro" />
				</p>
			</div>
			<div class="flex justify-end w-full md:w-1/2">
				<cloud-image-manager v-model="content.intro_image">
					<div slot-scope="{ chooseImage, images, public_id, setImage, modalVisable, hideModal }" class="relative w-full">
						<cl-image 
							style="object-fit: cover;"
							class="w-full border-b-8 border-r-8 border-brown h-48 md:h-auto"
							:public-id="content.intro_image" 
							:options="{ crop: 'fill', width: 400, height: 400 }"
						/>
						<button @click="chooseImage" class="absolute pin-t pin-r btn btn-sm btn-yellow m-4">Vælg Billede</button>
						<modal v-if="images.length && modalVisable" v-on:close="hideModal">
							<template slot="title">
								Vælg et cover billede
							</template>
							<div class="flex flex-row flex-wrap">
								<div
									class="mr-2 cursor-pointer"
									v-for="image in images"  
									:key="image.public_id"
									@click="setImage(image.public_id)"
								>
									<cl-image 
										:public-id="image.public_id"
										:options="{ aspectRatio: '1:1', crop: 'fill',  width: 100 }"
									/>
								</div>
							</div>
						</modal>
					</div>
				</cloud-image-manager>
			</div>
		</section>
		<section class="bg-brown-light text-green mt-12">
			<div class="container px-6 mx-auto">
				<div class="flex">
					<div class="flex flex-col w-full py-12 md:w-2/3">
						<h2 class="text-4xl mb-4">
							<editor :options="{disableReturn: true}" v-model="content.menu_title" />
						</h2>
						<div class="m-0 md:mr-16">
							<editorRepeater v-model="content.menu" :item-schema="{name: '', price: ''}">
								<ul class="list-reset flex-1" slot-scope="{ items, addRow, removeRow }">
									<li class="flex mb-2" v-for="(item, index) in items" :key="item._key">
										<p class="flex-1">
											<editor :options="{disableReturn:true}" v-model="item.name"/>
										</p>
										<b>
											<editor placeholder="pris" placeholder-right :options="{disableReturn:true}" v-model="item.price" />
										</b>
										<b>kr</b>
										<button class="btn btn-sm btn-white ml-2" @click="removeRow(index)">Fjern</button> 
									</li>
									<button class="btn btn-sm btn-white" @click="addRow">Tilføj menupunkt</button>
								</ul>
							</editorRepeater>
						</div>
					</div>
					<div class="hidden flex-1 w-1/3 md:flex">
						<cloud-image-manager v-model="content.menu_image">
							<div slot-scope="{ chooseImage, images, public_id, setImage, modalVisable, hideModal }" class="relative flex-1">
								<cl-image 
									class="bg-cover bg-no-repeat h-full w-full" 
									:options="{ crop: 'scale', width: 500, effect: 'colorize:50', color: '#f2e3b4' }"
									:public-id="content.menu_image">
									<i></i>
								</cl-image>
								<button @click="chooseImage" class="absolute pin-t pin-r btn btn-sm btn-white btn-yellow m-4">Vælg Billede</button>
								<modal v-if="images.length && modalVisable" v-on:close="hideModal">
									<template slot="title">
										Vælg et cover billede
									</template>
									<div class="flex flex-row flex-wrap">
										<div
											class="mr-2 cursor-pointer"
											v-for="image in images"  
											:key="image.public_id"
											@click="setImage(image.public_id)"
										>
											<cl-image 
												:public-id="image.public_id"
												:options="{ aspectRatio: '1:1', crop: 'fill',  width: 100 }"
											/>
										</div>
									</div>
								</modal>
							</div>
						</cloud-image-manager>
					</div>
				</div>
			</div>
		</section>
		<section class="bg-green text-brown-light flex-1">
			<div class="container px-6 mx-auto py-12 mb-12 flex">
				<div class="flex-1">
					<h2 class="mb-2">Her kan du finde os</h2>
					<address>
						<editor v-model="content.contact.address.street" /><br>
						<editor class="no-icon" v-model="content.contact.address.postcode" />
						<editor class="no-icon" v-model="content.contact.address.city" />
					</address>
					<br>
					<span><editor :options="{disableReturn: true}" v-model="content.contact.email" /></span><br>
					<span><editor :options="{disableReturn: true}" v-model="content.contact.phone" /></span>
					<br>
					<br>
					<p>
						<span>@<editor :options="{disableReturn: true}" v-model="content.social.instagram" /><br></span>
						<span>/<editor :options="{disableReturn: true}" v-model="content.social.facebook" /></span>
					</p>
				</div>
				<div class="flex-1">

				</div>
			</div>
		</section>
	</main>
</template>

<script>
	import store from '../../store';
	import editor from '../components/editor.vue'
	import editorRepeater from '../components/editorRepeater.vue'
	import CloudImageManager from '../components/CloudImageManager.vue'
	import Modal from '../components/Modal.vue'

	export default {
		data: vm => ({
			content: store.getters.content
		}),
		components: {
			editor,
			editorRepeater,
			CloudImageManager,
			Modal
		}
	}
</script>