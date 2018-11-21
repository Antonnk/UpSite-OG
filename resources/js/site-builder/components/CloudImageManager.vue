<script>
  export default {
    props: ['value', 'options'],
    data: vm =>  ({
      public_id: null,
      images: [],
      modalVisable: false,
    }),
    methods: {
      setImage(public_id) {
        this.public_id = public_id
        this.modalVisable = false
        this.$emit('input', this.public_id)
      },
      chooseImage() {
        axios.get('/images/cafe')
        .then(response => {
          this.modalVisable = true
          this.images = response.data.images;
        })
      }
    },
    created() {
      this.public_id = this.value;
    },
    render() {
      return this.$scopedSlots.default({
        chooseImage: this.chooseImage,
        setImage: this.setImage,
        public_id: this.public_id,
        images: this.images,
        modalVisable: this.modalVisable,
        hideModal: () => this.modalVisable = false
      }) 
    }
  }
</script>