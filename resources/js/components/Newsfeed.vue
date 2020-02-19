<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4"  v-for="item in results">
                <div class="card mb-6 shadow-sm">
                    <img :src=item.urlToImage :alt= item.content width="250px" class="card-img-top">
                    <div class="card-body">
                        <h3 class="card-title"><a :href=item.url target="_blank">{{ item.title }}</a></h3>
                        <p class="card-text">{{ item.description }}
                            <br>
                            <small><em>{{moment(item.publishedAt).format("Do MMM YYYY hh:mm a") }}</em></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    const url ="https://newsapi.org/v2/top-headlines?sources=bbc-news&apiKey=7210fbd55dc64565b5dd2830b98073bc";

    import moment from 'moment'
    export default {
        data() {
            return {
                results: [],
                //  loading: true,
            }
        },
        computed: {

        },
        created() {
          //  axios.get(url).then(console.log);
            axios.get(url).then(response => {
                this.results = response.data.articles;
                this.pubdate = response.data.articles.publishedAt;
                console.log(response.results);
            })
        }
    }

</script>
