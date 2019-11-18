<template>
  <div class="pagination-wrapper">
    <ul class="flex">
      <li v-for="i in totalPages" :key="i">
        <a
          :class="currentPage === i ? 'bg-yellow-primary text-white font-bold' : ''"
          class="p-3 rounded-full border-solid border border-grey-800"
          href="#"
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
    }
  }
};
</script>