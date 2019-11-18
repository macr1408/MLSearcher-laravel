<template>
  <div :class="customClasses" @click="openAccordion()">
    <span>
      {{ title }}
      <svg
        height="20px"
        width="20px"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="none"
        x="0px"
        y="0px"
        class="absolute chevron"
        :class="chevronInverse ? 'inverse' : ''"
      >
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M12.3284 1.41418L2.82843 10.9142L12.3284 20.4142L10.9142 21.8284L0 10.9142L10.9142 -2.86102e-05L12.3284 1.41418Z"
          transform="translate(22.9142 18) scale(-1 1) rotate(-90)"
          fill="black"
        />
      </svg>
    </span>
    <div v-if="showFilters">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
    customClasses: {
      type: String
    }
  },
  data() {
    return {
      chevronInverse: false,
      showFilters: false
    };
  },
  methods: {
    openAccordion() {
      this.chevronInverse = !this.chevronInverse;
      this.showFilters = !this.showFilters;
    }
  }
};
</script>

<style>
.chevron {
  top: 20px;
  right: 20px;
}
</style>