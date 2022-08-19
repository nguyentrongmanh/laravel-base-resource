<template>
  <form method="GET" :action="url" class="input-search">
    <input type="hidden" name="limit" :value="pageLimit" />
    <div class="input-group d-flex">
      <custom-input
        :height="35"
        :width="'calc(100% - 40px)'"
        :name="'search_input'"
        :type="'text'"
        :value="dataQuery.search_input"
        :initValue="dataQuery.search_input"
      />
      <span class="input-group-append">
        <custom-button
          :classes="'btn-primary'"
          :type="'submit'"
          :width="40"
          :height="35"
        >
          <template slot="body">
            <i class="fa fa-search" aria-hidden="true"></i>
          </template>
        </custom-button>
      </span>
    </div>
  </form>
</template>

<script>
export default {
  props: ["url", "pageLimit", "dataQuery"],
};
</script>
