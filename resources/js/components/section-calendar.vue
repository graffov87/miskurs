<template>
    <div class="flex flex-col bg-white max-w-sm px-6 py-4 mx-auto rounded-lg shadow-md gap-4">
        <div class="calend">
            <transition-group name="fade" tag="div">
              <div class="calend" v-for="i in [currentIndex]" :key="i" v-html="currentImg">
              </div>
            </transition-group>
          </div>
        <div v-html="calendHtml"></div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data() {
        return {
            calendHtml: "",
            imgs:[],
            timer: null,
            currentIndex: 0
           
        }
    },
    methods: {
        async getData() {
                const endpoint = "https://azbyka.ru/days/widgets/presentations.json?image=1";
                const headers = {
                    "content-type": "application/json",
                };
             

                const options = {
                    "method": "GET",
                    "headers": headers
                };

                const response = await fetch(endpoint, options);
                const data = await response.json();
                this.calendHtml = data.presentations;
                this.imgs = data.imgs;
                this.timer = setInterval(this.next, 9000);

            },

    next: function() {
      this.currentIndex += 1;
    },
    prev: function() {
      this.currentIndex -= 1;
    }
    },
    mounted() {
      this.getData()
    },
    computed: {
    currentImg: function() {
      return this.imgs[Math.abs(this.currentIndex) % this.imgs.length];
    }
  }
    }
</script>