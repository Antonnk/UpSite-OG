<template>
  <div>
    <div>
        <tabs :options="{ useUrlFragment: false }">
            <tab name="Hverdage">
              <div class="flex items-center mb-3" v-for="day in weekdays">
                <span class="flex w-24">{{ translateDayName(day.name) }}</span>
                <input type="time" v-model="day.open" value="10:00" step="900" class="border p-1 px-2 mr-2 rounded w-24">
                <input type="time" v-model="day.close" value="18:00" step="900" class="border p-1 px-2 mr-2 rounded w-24">
              </div>
            </tab>
            <tab name="Helligdage">
              <div class="flex items-center mb-3" v-for="day in exceptions">
                <input type="text" v-model="day.name" class="border p-1 px-2 mr-2 rounded w-24">
                <input type="time" v-model="day.open" step="900" class="border p-1 px-2 mr-2 rounded w-24">
                <input type="time" v-model="day.close" step="900" class="border p-1 px-2 mr-2 rounded w-24">
              </div>
            </tab>
        </tabs>
    </div>
    <hr>
    <button @click="updateOpenhours" class="btn">Gem</button>
  </div>
</template>


<script>
  import {Tabs, Tab} from 'vue-tabs-component';
  import store from '../../store'
  
  export default {
    data: vm => ({
      exceptions: store.getters.openhours.exceptions,
      weekdays: store.getters.openhours.weekdays
    }),
    methods: {
      updateOpenhours() {
        store.dispatch('setOpenhours', {
         weekdays: this.weekdays, 
         exceptions: this.exceptions
       })
      },
      translateDayName(dayName) {
        return {
          monday: 'Mandag',
          tuesday: 'Tirsdag',
          wednesday: 'Onsdag',
          thursday: 'Torsdag',
          friday: 'Fredag',
          saturday: 'Lørdag',
          sunday: 'Søndag',
        }[dayName]
      }
    },
    components: {
      Tabs, Tab
    }
  }
</script>

<style>
  .tabs-component-tabs {
    @apply flex justify-around list-reset mb-3 -mx-3 -mt-3;
  }

  .tabs-component-tab {
    @apply border border-grey-light border-t-0 flex-1 py-2 text-center;
  }
  .tabs-component-tab.is-active {
    @apply border-b-0;
  } 

  .tabs-component-tab-a {
    @apply no-underline text-grey-dark;
  }

  .is-active .tabs-component-tab-a  {
    @apply text-black;
  }
</style>