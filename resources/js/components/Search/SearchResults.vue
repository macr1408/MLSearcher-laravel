<template>
  <div class="search-results-wrapper flex flex-wrap container">
    <Accordion
      title="Filter by"
      customClasses="search-filter lg:hidden bg-gray-200 w-full p-4 relative"
    >asd</Accordion>
    <div class="search-sidebar mt-5 hidden lg:block lg:w-3/12"></div>
    <div class="placeholder-items-wrapper w-9/12 ph-item" v-if="searchResults === null">
      <div
        class="shadow w-44-percent lg:w-30-percent inline-block m-2 p-5"
        v-for="index in 9"
        :key="index"
      >
        <div class="ph-col-12">
          <div class="ph-picture"></div>
          <div class="ph-row">
            <div class="ph-col-12 big"></div>
            <div class="ph-col-4 big"></div>
            <div class="ph-col-10 big"></div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="search-results mt-5 w-full lg:w-9/12 flex flex-wrap p-2"
      v-if="searchResults !== null"
    >
      <search-item
        v-for="(product, index) in searchResults.results"
        :key="index"
        :item="{
          title: product.title,
          img: product.thumbnail,
          price: product.price,
          state: product.address.state_name,
          city: product.address.city_name,
          link: product.permalink
          }"
        custom-class="m-2"
      ></search-item>
    </div>
  </div>
</template>

<script>
export default {
  props: ["searchTerm"],
  data() {
    return {
      searchResults: null
    };
  },
  mounted() {
    axios
      .get(`https://api.mercadolibre.com/sites/MLA/search?q=${this.searchTerm}`)
      .then(response => {
        this.searchResults = response.data;
      });
  }
};
</script>
