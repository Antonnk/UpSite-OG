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
    placeholderRight: Boolean,
    asHtml: {
      type: Boolean,
      default: false
    }
  },
  mounted() {
    this.editor = new MediumEditor(this.$el, {
      spellcheck: false,
      toolbar: false,
      placeholder: {
        text : this.placeholder
      },
      paste: {
        forcePlainText: true,
        cleanPastedHTML: true,
      },
      ...this.options
    })

    this.editor.setContent(this.value)

    this.editor.subscribe('editableInput', () => {
      
      let content = this.editor.getContent()

      if(!this.asHtml) content = this.stripTags(content)

      this.$emit('input', content)
    });
  },
  methods: {
    stripTags(string) {
      var div = document.createElement("div");
      div.innerHTML = string;
      return div.textContent || div.innerText || "";
    }
  },
  beforeDestroy() {
  	this.editor.destroy()
  }
}
</script>

<style scoped>
	@import '//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css';

  .medium-editor-element {
    min-height: 20px !important;
    display: inline-block;
    position: relative;
  }

  .medium-editor-element::after {
    content: "";
    height: 15px;
    width: 15px;
    display: block;
    position: absolute;
    top: -15px;
    right: -20px;
    opacity: .5;
    background-image: url("data:image/svg+xml,%0A%3Csvg viewBox='0 0 20 20' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'%3E%3Cg id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd'%3E%3Cg id='Group'%3E%3Crect id='Rectangle' fill='%23C8C8C8' x='0' y='0' width='20' height='20' rx='10'%3E%3C/rect%3E%3Cg id='edit-pencil' transform='translate(5.000000, 5.000000)' fill='%23000000' fill-rule='nonzero'%3E%3Cpath d='M6.15,1.85 L8.15,3.85 L2,10 L0,10 L0,8 L6.15,1.85 Z M6.85,1.15 L8,0 L10,2 L8.85,3.15 L6.85,1.15 Z' id='Shape'%3E%3C/path%3E%3C/g%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }

  .medium-editor-element.no-icon::after {
    display: none;
  }

  .medium-editor-element:focus::after {
    opacity: .9;
    box-shadow: none;
  }

  .medium-editor-element:focus {
    outline: 0;
    box-shadow: 0 0 0 1px rgba(52, 144, 220, .5);
  }

  .placeholder-right.medium-editor-placeholder:after {
    right: 0;
    left: initial;
  }
</style>