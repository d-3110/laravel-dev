<template>
<div class="form-group form-inline">
  <select class="form-control" v-model="year" @change="select" name="birthday">
    <option v-for="n in 30" :value="n + 1980">
      {{ n + 1980 }}
    </option>
  </select><div>年</div>
  <select class="form-control" v-model="month" @change="select">
    <option v-for="n in 12" :value="n">
      {{ n }}
    </option>
  </select>月
   <select class="form-control" v-model="day" @change="select">
    <option v-for="n in days_max" :value="n">
      {{ n }}
    </option>
  </select>日
</div>
</template>

<script>
export default {
  props:['birth_day'],
   data() {
    return {
      year: 2019,
      month: 1,
      day: 1,
      days_max: '',
     }
   },
   created: function () {
    this.splitBirthDay()
    this.getDays()
   },
   methods: {
    // 日付を年・月・日に分割
    splitBirthDay() {
      var result = this.birth_day.split('-')
      this.year = result[0]
      this.month = Number(result[1])
      this.day = result[2]
    },
    // 日の最大数を取得
    getDays: function () {
      this.days_max = new Date(this.year, this.month, 0).getDate()
    },
    
    // 親コンポーネントの値を更新
    select() {
      this.getDays()
      this.$parent.req.birthday = this.year + '-' + this.month + '-' + this.day
    }
   }
}
</script>