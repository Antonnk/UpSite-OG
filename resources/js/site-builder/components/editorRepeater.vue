<script>
	export default {
		props: ['value', 'item-schema'],
		data: vm => ({
			items: []
		}),
		methods: {
			addRow() {
				this.items.push(this.itemSchema)
				this.update()
			},
			removeRow(index) {
				this.items.splice(index, 1)
				this.update()
			},
			update() {
				this.$emit('input', this.getItems)		
			}
		},
		computed: {
			getItems() {
				return this.items.map(item => {
					return {
						_key: Math.random().toString(36).substring(7),
						...item
					}
				})
			}
		},
		created() {
			this.items = this.value
		},
		render() {
			return this.$scopedSlots.default({
				items: this.getItems,
				addRow: this.addRow,
				removeRow: this.removeRow
			}) 
		}
	}
</script>