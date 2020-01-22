<template>
  <transition name="fade">
    <div class="p-2" v-if="this.show === true" @click="hideNotification">
      <div
        class="cursor-pointer inline-flex items-center bg-white leading-none font-bold rounded-full p-2 shadow text-teal text-sm"
      >
        <span
          class="inline-flex bg-green-400 text-white rounded-full h-6 px-3 justify-center items-center"
          v-if="type === 'success'"
        >✓</span>
        <span
          class="inline-flex bg-red-400 text-white rounded-full h-6 px-3 justify-center items-center"
          v-if="type === 'error'"
        >X</span>
        <span
          class="inline-flex bg-blue-400 text-white rounded-full h-6 px-3 justify-center items-center"
          v-if="type === 'info'"
        >!</span>
        <span class="inline-flex px-2">
          <slot></slot>
        </span>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: ["type"],
  data() {
    return {
      show: true
    };
  },
  methods: {
    hideNotification: function() {
      this.show = false;
    }
  },
  mounted() {
    setTimeout(() => {
      this.show = false;
    }, 5000);
  }
};
</script>

<style>
</style>