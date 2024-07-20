<template>
  <div class="card leaveTable-card">
    <div class="card-header" id="input-valuses-accordOne">
      <h2 class="mb-0">
        <button @click.prevent="togglePanel" class="btn btn-link btn-block text-left"
          :class="{ 'collapsed': showPanel }" type="button" data-toggle="collapse"
          data-target="#input-valuses-accord-collapseOne" :aria-expanded="showPanel"
          aria-controls="input-valuses-accord-collapseOne">
          {{ title }}
        </button>
      </h2>
    </div>

    <div id="input-valuses-accord-collapseOne" :class="{ 'show': showPanel }" class="collapse"
      aria-labelledby="input-valuses-accordOne" data-parent="#input-valuses-accord">
      <section class="d-flex flex-column" v-if="showPanel">
        <slot></slot>
      </section>
    </div>
  </div>

</template>

<script setup>
import { ref } from 'vue';
const props = defineProps({
  title: { type: String, required: true },
  ariaTitle: { type: String, required: true }
});
const showPanel = ref(false);
const togglePanel = (event) => {
  showPanel.value = !showPanel.value;
}
</script>

<style scoped>
@import '@/assets/css/planner.css';
@import '@/assets/css/onBoard.css';

.form-row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -5px;
  margin-left: -5px;
}
</style>