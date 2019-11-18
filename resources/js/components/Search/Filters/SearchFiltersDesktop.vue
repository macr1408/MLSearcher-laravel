<template>
  <div class="search-sidebar mt-5 hidden lg:block p-2 h-0">
    <h4 class="text-gray-700">Filtrar por</h4>
    <div class="px-4 my-2 text-sm" v-for="(value, index) in filters" :key="index">
      <h5
        class="border-b-2 border-yellow-primary border-solid inline-block mb-2 font-bold"
      >{{ value.name }}</h5>
      <ul>
        <li v-for="(value2,index2) in value.values" :key="index2" class="py-1">
          <a
            :href="getSearchUrlWithParameter(value['id'], value2['id'])"
          >{{ value2.name }} ({{ value2.results }})</a>
        </li>
      </ul>
    </div>
  </div>
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