<template>
  <div>
    <slot></slot>
  </div>
</template>


<script>
export default {
  methods: {
    logScroll(pos) {
      this.$el.style.transform = 'translateY('+pos / 10+'px)'
    }
  },
  mounted() {
    window.addEventListener('scroll', (e) => {
      const last_known_scroll_position = window.scrollY;
      let ticking = false
      if (!ticking) {
        window.requestAnimationFrame(() => {
          this.logScroll(last_known_scroll_position);
          ticking = false;
        });

        ticking = true
      }
    });
  }
}
</script>
