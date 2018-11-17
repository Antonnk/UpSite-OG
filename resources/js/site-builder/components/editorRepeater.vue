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
			removeRow(item) {
				this.items.splice(this.items.indexOf(item), 1)
				this.update()
			},
			update() {
				this.$emit('input', this.items)		
			}
		},
		created() {
			this.items = this.value
		},
		render() {
			return this.$scopedSlots.default({
				items: this.items,
				addRow: this.addRow,
				removeRow: this.removeRow
			}) 
		}
	}
</script>