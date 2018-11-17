<template>
	<component :value="content" :is="setComponent"></component>
</template>

<script>
	import store from '../store';
	import LoadingComponent from './components/Loading.vue'
	import ErrorComponent from './components/Error.vue'

	export default {
		props: {
			initMode: String,
			initTheme: String,
			content: Object
		},
		data: vm => ({
			theme: vm.initTheme
		}),
		created() {
			if(this.initMode) {
				store.commit(`setMode${this.initMode}`)
			}
		},
		computed: {
			getMode() {
				return store.getters.mode
			},
			setComponent() {
				this.getMode; // call to evaluate mode before import
				return () => ({
					// The component to load (should be a Promise)
					component: import(`./theme/${this.theme}${this.getMode}.vue`),
					// A component to use while the async component is loading
					loading: LoadingComponent,
					// A component to use if the load fails
					error: ErrorComponent,
					// Delay before showing the loading component. Default: 200ms.
					delay: 200,
					// The error component will be displayed if a timeout is
					// provided and exceeded. Default: Infinity.
					timeout: 3000
				})
			}
		}
	}
</script>