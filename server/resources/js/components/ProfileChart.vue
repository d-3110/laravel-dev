<script>
import { Radar } from 'vue-chartjs';
/**
 * Bar       : 棒グラフ
 * Line      : 折れ線グラフ
 * Doughnut  : ドーナツグラフ
 * Pie       : 円グラフ
 * Radar     : レーダーグラフ
 * Polararea : 極域グラフ
 * Bubble    : バブルグラフ
 * Scatter   : 散布図（mixinでは未対応とのこと）
 **/

export default {
  extends: Radar,
  mounted() {
    this.renderChart(
      {
        labels: [
          'ＨＰ',
          'ＭＰ',
          'こうげき',
          'しゅび',
          'すばやさ',
          'かしこさ',
        ],
        datasets: [
          {
            label: 'すてーたす',
            pointBackgroundColor: '#34495e', // 結合点の色
            //背景色
            backgroundColor: '#f87979',
            //枠線の色
            borderColor: 'rgba(26,188,156,1)',
            //結合点の背景色
            pointBackgroundColor: 'rgba(26,188,156,1)',
            //結合点の枠線の色
            pointBorderColor: 'rgba(26,188,156,1)',
            //結合点の背景色（ホバーしたとき）
            pointHoverBackgroundColor: '#fff',
            //結合点の枠線の色（ホバーしたとき）
            pointHoverBorderColor: 'rgba(26,188,156,1)',
            //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
            hitRadius: 5,
            data: [this.$parent.req.personality_1,
                   this.$parent.req.personality_2,
                   this.$parent.req.personality_3,
                   this.$parent.req.personality_4,
                   this.$parent.req.personality_5, 
                   this.$parent.req.personality_6
                   ],
            backgroundColor: [
                'rgba(26,188,156,0.5)'
            ]
          }
        ],
      },
      {
        // optionだよ
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
         },
        scale: {
          ticks: {
              beginAtZero: true,
              max: 5,
              min: 0
          }
        }
      },
    )
  }
}
</script>