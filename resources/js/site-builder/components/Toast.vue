<template>
  <transition name="fade">
    <div class="fixed m-8 pin-b pin-r z-50" v-if="status.length > 0">
      <transition-group name="fade">
        <div v-for="(item, index) in status" :key="`item${index}`" :class="item.type" class="py-3 px-6 my-1 bg-white">
            <h2>{{ item.msg }}</h2>
        </div>
      </transition-group>
    </div>
  </transition>
</template>

<script>
  import {mapGetters} from 'vuex';

  export default {
    computed: mapGetters(['status']),
    created() {
      
    }
  }
</script>

<style>
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
  }
</style>