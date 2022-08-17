<template>
  <div class="container-fluid">
    <div class="fade-in">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mb-4">
            <div class="card-header">
              <strong>Form control</strong>
            </div>
            <div class="card-body">
              <div class="example">
                <div class="mb-3">
                  <label class="form-label">Default input example</label>
                  <custom-input
                    :width="'100%'"
                    :height="40"
                    :placeholder="'Default input'"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">Default textarea example</label>
                  <custom-textarea
                    :width="'100%'"
                    :placeholder="'Default textarea'"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">Default select example</label>
                  <custom-select
                    :width="'100%'"
                    :options="['One', 'Two', 'Three']"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">Default radio example</label>
                  <custom-radio
                    :customClass="'form-check-inline'"
                    :options="[
                      {
                        value: 'One',
                        label: 'One',
                      },
                      {
                        value: 'Two',
                        label: 'Two',
                      },
                      {
                        value: 'Three',
                        label: 'Three',
                      },
                    ]"
                  />
                </div>
                <div class="mb-3">
                  <label class="form-label">Default checkbox example</label>
                  <div>
                    <custom-checkbox
                      :customClass="'form-check-inline'"
                      :title="'One'"
                      :name="'checkbox1'"
                    />
                    <custom-checkbox
                      :customClass="'form-check-inline'"
                      :title="'Two'"
                      :name="'checkbox2'"
                    />
                  </div>
                </div>
                <div class="mb-3">
                  <label class="form-label">Button</label>
                  <div>
                    <custom-button :label="'submit'" @click="test"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CustomCheckbox from "../Commons/form/CustomCheckbox.vue";
export default {
  components: { CustomCheckbox },
  data() {
    return {
      radioBtn: "One",
    };
  },
  props: {},
  methods: {
    async test() {
      await console.log('test babel');
    }
  },
};
</script>
