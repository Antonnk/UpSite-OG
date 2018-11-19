<template>
  <span :class="{ 'placeholder-right' : this.placeholderRight }"></span>
</template>


<script>
import MediumEditor from 'medium-editor'

export default {
  props: {
    value: [String, Number],
    options: Object,
    placeholder: {
      type: String,
      default: 'Skriv...'
    },
    placeholderRight: Boolean
  },
  mounted() {
    this.editor = new MediumEditor(this.$el, {
      toolbar: false,
      placeholder: {
        text : this.placeholder
      },
      ...this.options
    })

    this.editor.setContent(this.value)

    this.editor.subscribe('editableInput', () => {
      this.$emit('input', this.editor.getContent())
    });
  },
  beforeDestroy() {
  	this.editor.destroy()
  }
}
</script>

<style>
	@import '//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css';
</style>