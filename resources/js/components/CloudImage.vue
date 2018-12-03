<script>
	import cloudinary from 'cloudinary-core'

	export default {
		render(createElement) {
			return createElement(this.containerTag, {
				attrs: {
					src: this.url
				},
				style: this.backgroundStyle
			},
			this.$slots.default
			)
		},
		props: {
			publicId: {
				type: String
			},
			clName: {
				type: String,
				default: ''
			},
			options: {
				type: Object,
				default: () => ({})
			},
			tag: {
				type: String,
				default: 'div'
			}
		},
		computed: {
			url() {
				return this.cl.url(this.publicId, this.options);
			},
			isContainer() {
				return !!this.$slots.default
			},
			backgroundStyle() {
				return {
					backgroundImage: `url(${this.url})`
				}
			}
		},
		created() {
			this.cl = new cloudinary.Cloudinary();
			this.cl.init();
			if(this.clName !== '') this.cl.config({cloud_name: this.clName})

			this.containerTag = (this.isContainer ? this.tag : 'img')
		}
	}
</script>