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
				this.$emit('input', this.items)		
			}
		},
		watch: {
			items(newValue, oldValue) {
				this.update()
			}
		},
		computed: {
			getItems: {
				get() {
					return this.items.map(item => {
						return {
							_key: Math.random().toString(36).substring(7),
							...item
						}
					})
				}
			}
		},
		created() {
			this.items = this.value.map(item => {
				return {
					_key: Math.random().toString(36).substring(7),
					...item
				}
			})
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