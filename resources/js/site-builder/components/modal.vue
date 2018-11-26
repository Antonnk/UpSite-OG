<template>
	<portal to="modal">
		<div id="overlay" class="fixed flex h-screen items-center justify-center pin-t w-screen">
			<div class="bg-white rounded shadow">
				<div class="flex items-baseline border-b border-grey p-3">
					<h3 class="flex-1">
						<slot name="title"></slot>
					</h3>
					<svg v-if="!noClose" class="w-3 cursor-pointer" @click="$emit('close')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
				</div>
				<div class="p-3">
					<slot></slot>
				</div>
			</div>
		</div>
	</portal>
</template>

<script>
	export default {
		props: {
			noClose: {
				type: Boolean,
				default: false
			}
		}
	}
</script>

<style scoped>
	#overlay {
		background: rgba(97, 97, 97, 0.23);
	}
</style>