<template>
  <div class="search-results-wrapper flex flex-wrap container">
    <search-filters
      :filters="searchResults? searchResults.available_filters : []"
      :update-url-action="createSearchUrlWithParameter"
    ></search-filters>
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
      class="search-results mt-5 w-full lg:w-9/12 flex flex-wrap p-2 justify-around md:justify-start"
      v-else-if="searchResults"
    >
      <search-item
        v-for="(product, index) in searchResults.results"
        :key="index"
        :item="product"
        custom-class="m-2"
      ></search-item>
      <pagination
        v-if="searchResults"
        :total-pages="totalPages()"
        :current-page="currentPage()"
        :on-navigate="createSearchUrlWithParameter"
        custom-class="my-4"
      ></pagination>
    </div>
    <div class="search-results mt-5 w-full lg:w-9/12 flex flex-wrap p-2" v-else>
      <h1 class="text-4xl italic text-gray-700">Sin resultados :(</h1>
    </div>
  </div>
</template>

<script>
export default {
  props: ["searchTerm", "currentUrl", "searchFilters", "apiToken"],
  data() {
    return {
      searchResults: null
    };
  },
  methods: {
    totalPages() {
      return Math.ceil(
        this.searchResults.paging.total / this.searchResults.paging.limit
      );
    },
    currentPage() {
      let currentPage =
        this.searchResults.paging.offset / this.searchResults.paging.limit;
      return currentPage ? currentPage + 1 : 1;
    },
    createSearchUrlWithParameter(param, value) {
      let url = new URL(this.currentUrl);
      url.searchParams.set(param, value);
      return url;
    }
  },
  mounted() {
    const filters = JSON.parse(this.searchFilters);
    const self = this;

    axios
      .post(
        "/api/search",
        {
          q: this.searchTerm,
          filters
        },
        {
          headers: {
            Authorization: "Bearer " + this.apiToken
          }
        }
      )
      .then(response => {
        this.searchResults = response.data;
      })
      .catch(function(error) {
        alert(error.response.data.error);
        self.searchResults = error.response.data.products;
      });
  }
};
</script>