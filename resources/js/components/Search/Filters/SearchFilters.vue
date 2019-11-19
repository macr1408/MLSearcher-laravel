<template>
  <div class="search-filters-wrapper w-full lg:w-3/12">
    <search-filters-mobile :filters="filters" :update-url-action="updateUrlAction"></search-filters-mobile>
    <search-filters-desktop :filters="filters" :update-url-action="updateUrlAction"></search-filters-desktop>
  </div>
</template>

<script>
export default {
  props: {
    filters: {
      type: Array,
      required: true
    },
    updateUrlAction: {
      type: Function,
      required: true
    }
  }
};
</script>