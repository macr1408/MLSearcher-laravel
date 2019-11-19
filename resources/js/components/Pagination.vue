<template>
  <div class="pagination-wrapper">
    <ul class="flex">
      <li v-for="i in totalPages" :key="i">
        <a
          :class="currentPage === i ? 'bg-yellow-primary text-white font-bold' : ''"
          class="p-3 rounded-full border-solid border border-grey-800"
          :href="handleNavigate(i-1)"
        >{{ i }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    totalPages: {
      type: Number,
      required: true
    },
    onNavigate: {
      type: Function,
      required: true
    }
  },
  methods: {
    handleNavigate(page) {
      return this.onNavigate("offset", page * 50);
    }
  }
};
</script>