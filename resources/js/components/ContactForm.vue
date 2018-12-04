<template>
	<form method="post" class="relative p-2" @submit.prevent="handleSubmit" @keydown="form.errors.clear($event.target.name)">
		
		<div class="mb-3">
			<label for="email" class="uppercase font-bold italic text-blue-lightest text-lg tracking-wide mb-1 inline-block">Email</label>
			<input v-model="form.email" name="email" class="bg-grey-lighter input" placeholder="mail@email.dk" type="email" id="email">
			<i class="label-error" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></i>
		</div>

		<div class="mb-3">
			<label for="message" class="uppercase font-bold italic text-blue-lightest text-lg tracking-wide mb-1 inline-block">Besked eller spørgsmål</label>
			<textarea v-model="form.message" id="message" name="message" class="bg-grey-lighter input"></textarea>
			<i class="label-error" v-if="form.errors.has('message')" v-text="form.errors.get('message')"></i>
		</div>

		<button class="btn" type="submit">Send!</button>
		<transition name="fade">
			<div v-if="successVisable" class="absolute bg-grey-lightest flex flex-col items-center justify-center pin text-center rounded">
				<span class="text-5xl">👍</span>
				<span class="font-bold mb-2 text-4xl text-blue">Tak for din besked!</span>
				<span class="text-blue">Vi vender tilbage hurtigst muligt.</span>
				<button type="button" @click="hideSuccess" class="absolute font-bold inline-block mb-1 p-2 pin-r pin-t text-blue-lightest text-2xl tracking-wide uppercase">&times;</button>
			</div>
		</transition>
	</form>
</template>

<script>
	import Form from '../Helpers/Form.js'

	export default {
		props: ['action'],
		data: vm => ({
			successVisable: false,
			form: new Form({
				email: null,
				message: null,
			})
		}),
		methods: {
			handleSubmit(e) {
				this.form.post(this.action)
				.then(res => {
					this.successVisable = true
				})
			},
			hideSuccess() {
				this.successVisable = false;	
			}
		}
	}
</script>

 <style scoped>
	.fade-enter-active, .fade-leave-active {
		transition: all .3s;
	}
	.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
		opacity: 0;
		transform: scale(.8);
	}
</style>