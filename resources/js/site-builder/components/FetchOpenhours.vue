<script>
  import store from '../../store'
  
  export default {
    props: {
      openhours: {
        type: Array,
        default: () => store.getters.openhours.weekdays
      }
    },
    computed: {
      weekdays() {
        return this.openhours.map(day => {
          return {
            name: day.name,
            title: this.translateDayName(day.name),
            open: day.open,
            close: day.close 
          }
        })
      },
      getToday() {
        return this.weekdays.filter(day => day.name == this.getCurrentDay())[0]
      },
      today() {
        let openNow = false

        if(this.getToday.close != null) {
          const closeTimeAsArray = this.getToday.close.split(':')
          let closeTime = new Date()
          closeTime.setHours(closeTimeAsArray[0], closeTimeAsArray[1])
          openNow = closeTime > new Date()
        }

        return {
          openNow: openNow,
          open: this.getToday.open,
          close: this.getToday.close
        }
      },
      nextOpenDay() {
        const nextOpenDay = this.weekdays.filter(day => day.open != null && day.close != null)[0] || false
        
        if(!nextOpenDay) return false

        return {
          name: this.translateDayName(nextOpenDay.name),
          open: nextOpenDay.open,
          close: nextOpenDay.close
        }
      }
    },
    methods: {
      getCurrentDay() {
        return ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']
                [new Date().getDay()]
                .toLowerCase()
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
    render() {
      return this.$scopedSlots.default({
        weekdays: this.weekdays,
        today: this.today,
        nextOpenDay: this.nextOpenDay
      }) 
    }
  }
</script>