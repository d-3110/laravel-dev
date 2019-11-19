<template>
  <div class="card mb-5 profile_card" :class="{ loading : loading }">
    <!-- 更新メッセージ -->
    <div v-if="updated" class="alert alert-primary" role="alert">
      更新しました
    </div>
    <!-- ロード画面 -->
    <div v-if="loading" class="spinner-border text-primary profile_spiner" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <form v-if="!loading" class="row no-gutters">
      <div class="col-md-4 profile_info">

        <!-- 表示エリア -->
        <div v-if="!editFlg"class="img_box" :class="{ gray_out: editFlg }">
          <img class="card-img-top profile_img" :src="/storage/ + req.img_file"/>
        </div>
        <!-- 編集エリア -->
        <div v-else class="img_box" :class="{ gray_out: editFlg }">
          <label>
            <img v-if="!req.uploaded_img" class="card-img-top profile_img" :src="/storage/ + old_img" alt="profile_img"/>
            <img v-else class="card-img-top profile_img" :src="req.uploaded_img" alt="profile_img"/>
            <input type="file" @change="fileSelected" name="profile_img" accept="image/png, image/jpeg" />
          </label>
          <div class="photo_icon">
            <i class="fui fui-photo"></i>
          </div>
          <!-- ファイル名エリア -->
          <div v-show="req.uploaded_img">
            <i @click="remove">close</i>
          </div>
        </div>

        <!-- 左側通常 -->
        <dl v-if="!editFlg">
          <dt>性別</dt>
          <dd>{{ gender }}</dd>
          <dt>生年月日</dt>
          <dd>{{ req.birthday }}</dd>
          <dt>好きな食べ物</dt>
          <dd>{{ req.favorite_food }}</dd>
          <dt>嫌いな食べ物</dt>
          <dd>{{ req.hated_food }}</dd>
        </dl>
        <!-- 左側編集 -->
        <dl v-else>
          <dt>性別</dt>
          <dd class="form-group">
            <select type="number" class="form-control form-select" name="gender" v-model="req.gender">
              <option value="0" :selected="!is_woman">男</option>
              <option value="1" :selected="is_woman">女</option>
            </select>
          </dd>
          <dt>生年月日</dt>
          <dd class="form-group">
            <input type="text" name="gender" class="form-control" v-model="req.birthday">
          </dd>
          <dt>好きな食べ物</dt>
          <dd>
            <input type="text" name="gender" class="form-control" v-model="req.favorite_food">
          </dd>
          <dt>嫌いな食べ物</dt>
          <dd>
            <input type="text" name="gender" class="form-control" v-model="req.hated_food">
          </dd>
        </dl>
      </div><!-- 左側END -->

      <!-- 右側通常(レーダーチャート) -->
      <div v-if="!editFlg" class="col-md-7">
        <div class="card-body">
          <div>
            <h5 class="card-title">
              {{req.name}}
            </h5>
          </div>
          <profile-chart></profile-chart>
        </div>
      </div>
      <!-- 右側編集エリア -->
      <div v-else class="col-md-7">
        <div class="card-body">
          <dl>
            <dt>なまえ</dt>
            <dd>
              <input type="text" name="name" class="form-control" v-model="req.name">
            </dd>
            <dt>ＨＰ</dt>
            <dd class="form-group">
              <input type="text" name="personality_1" class="form-control" v-model="req.personality_1">
            </dd>
            <dt>ＭＰ</dt>
            <dd class="form-group">
              <input type="text" name="personality_2" class="form-control" v-model="req.personality_2">
            </dd>
            <dt>こうげき</dt>
            <dd class="form-group">
              <input type="text" name="personality_3" class="form-control" v-model="req.personality_3">
            </dd>
            <dt>しゅび</dt>
            <dd class="form-group">
              <input type="text" name="personality_4" class="form-control" v-model="req.personality_4">
            </dd>
            <dt>すばやさ</dt>
            <dd class="form-group">
              <input type="text" name="personality_5" class="form-control" v-model="req.personality_5">
            </dd>
            <dt>かしこさ</dt>
            <dd class="form-group">
              <input type="text" name="personality_6" class="form-control" v-model="req.personality_6">
            </dd>
          </dl>
        </div>
      </div>
    </form><!-- wrrap END -->
    <!-- ボタンエリア　-->
    <div v-if="!editFlg && !loading" class="form-group btn_group">
      <button type="button" class="btn btn-primary edit_btn" @click="(editFlg = true)">
        <i class="fa fa-pencil"></i>
      </button>
    </div>
    <div v-else-if="!loading" class="form-group btn_group">
      <button type="button" class="btn btn-info edit_btn" @click="update">
        <i class="fui fui-check"></i>
      </button>
      <button type="button" class="btn btn-danger edit_btn" @click="(editFlg = false)">
        <i class="fui fui-cross"></i>
      </button>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import ProfileChart from './ProfileChart'


export default {
    
  // チャートコンポーネント
  components: {
      ProfileChart
  },
  // bladeからデータを受け取り
  props:["profile"],
  data() {
    return {
      // APIでpostするためのreq
      req: {
        id: this.profile.id,
        name: this.profile.name,
        gender: this.profile.gender,
        birthday: this.profile.birthday,
        favorite_food: this.profile.favorite_food,
        hated_food: this.profile.hated_food,
        img_file: this.profile.img_file, // アップロード画像ファイル名
        personality_1: this.profile.personality_1,
        personality_2: this.profile.personality_2,
        personality_3: this.profile.personality_3,
        personality_4: this.profile.personality_4,
        personality_5: this.profile.personality_5,
        personality_6: this.profile.personality_6,
        uploaded_img: '',   // アップロードファイルそのもの
        change_img: false,               // 画像を変えようとしていたらtrue
      },
      gender: '',
      editFlg: false,
      updated: false,
      is_woman: false,
      loading: false,
      old_img: '',  // 現在のプロフィール画像
    }
  },

  mounted: function () {
    // 性別の翻訳値を設定
    this.gender = this.setGender(this.profile.gender)
    // 現在のプロフィール画像を退避
    this.old_img = this.profile.img_file
  },

  methods: {
    // 性別設定
    setGender(gender) {
      if (gender == 0) {
        return '男'
      }
      this.is_woman = true
      return '女'
    },
    // 更新処理
    update() {
      this.loading = true
      axios.patch('/api/profiles/' + this.profile.id, this.req).then(res => {
          this.editFlg = false
          this.updated = true
          // 更新後も翻訳値を設定
          this.gender = this.setGender(this.req.gender)
          this.loading = false
      });
    },
    // 画像選択
    fileSelected(e){
      let files = e.target.files || e.dataTransfer.files
      this.previewImage(files[0])
      this.req.img_file = files[0].name
    },
    // プレビュー表示
    previewImage(file) {
      const reader = new FileReader()
      reader.onload = e => {
        this.req.uploaded_img = e.target.result
      };
      reader.readAsDataURL(file)
    },
    // ファイル削除
    remove() {
      this.req.uploaded_img = false
    },
  }
}
Vue.component('profile-chart', ProfileChart)

</script>
