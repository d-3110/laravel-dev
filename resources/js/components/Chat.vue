<template>
  <section class="chatWrap">
    <div id="chat" class="chat-card px-2">
      <!-- ロード画面 -->
      <div class="d-flex justify-content-center mt-auto">
        <div v-if="loading" class="spinner-border text-primary profile_spiner " role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <div v-if="first">
          <p>最初のメッセージを送信してください！</p>
        </div>
      </div>
      <div class="d-flex flex-column mt-auto">
        <div v-for="m in messages" class="balloon">
          <div v-if="m.user_id != user_id" class="faceicon">
            <img :src="m.img_file" alt="profile_img">
          </div>
          <div v-if="m.user_id != user_id" class="chatting">
            <div class="says">
              <p v-html="m.body"></p>
            </div>
          </div>
          <div v-else class="mycomment">
              <p v-html="m.body"></p>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <textarea v-model="message" class="message-area" @keyup.ctrl.enter="send()"></textarea>
      <button type="button" @click="send()" class="btn btn-primary">
        <i class="fa fa-paper-plane"></i>
      </button>
    </div>
  </section>
</template>

<script>
  export default {
    props:['group_id', 'user_id'],
    data() {
      return {
        messages: '',
        message: '',
        first: false,
        loading: true,
      }
    },
    mounted: function () {
      this.getMessages()
      const group_id = this.group_id
      Echo.private('chat.' + group_id)
        .listen('MessageCreated', (e) => {
            // 全メッセージを再読込
            this.getMessages();
        })
    },
    updated: function () {
      this.$nextTick(function () {
        this.scrollToEnd()
      })
    },
    methods: {
      send() {
        // メッセージが空の場合ajaxしない
        if (this.message === '') {
          return
        }
        const params = { 
                        message: this.message,
                        group_id: this.group_id,
                        user_id: this.user_id,
                      }
        axios.post('/api/chat', params).then(res => {
          // 成功したらメッセージクリア
          this.message = ''
          this.first = false;
        });
      },
      getMessages() {
        axios.get('/api/chat/' + this.group_id).then(res => {
          this.messages = res.data
          // 1度も会話していない場合
          if (this.messages.length == 0) {
            this.first = true;
          }
          this.loading = false
        })
        .catch(err => {
        this.loading = false
        })
      },
      scrollToEnd() {
        var container = this.$el.querySelector("#chat")
        container.scrollTop = container.scrollHeight;
      }
    }
  }
</script>
