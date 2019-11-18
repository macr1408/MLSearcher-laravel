<template>
  <Accordion
    title="Filtrar por"
    customClasses="search-filter lg:hidden bg-gray-200 p-4 text-xl"
    v-if="filters !== null"
  >
    <Accordion
      v-for="(value, index) in filters"
      :key="index"
      :title="value.name"
      customClasses="py-2 text-sm"
    >
      <ul class="px-2">
        <li v-for="(value2,index2) in value.values" :key="index2" class="py-1">
          <a
            :href="getSearchUrlWithParameter(value['id'], value2['id'])"
          >{{ value2.name }} ({{ value2.results }})</a>
        </li>
      </ul>
    </Accordion>
  </Accordion>
</template>

<script>
export default {
  props: {
    filters: {
      type: Array,
      required: true
    },
    currentUrl: {
      type: String,
      required: true
    }
  },
  methods: {
    getSearchUrlWithParameter(param, value) {
      let url = new URL(this.currentUrl);
      url.searchParams.set(param, value);
      return url;
    }
  }
};
</script>