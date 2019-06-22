// Vue.component('book-list', {
//     props: ['id', 'name'],
//     template: '<tr class="tr-shadow"><td>{{ id }}</td><td><span class="block-email">{{ name }}</span></td></tr><tr class="spacer"></tr>'
// })

const config = {
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    }
}

new Vue({
    el: '#book_table',
    data: {
        books: []
    },
    created: function () {
        var vm = this;
        axios.get("http://zedd.cc/?s=Book.GetAll")
            .then(response => {
                // console.log(response.data.data['info']);
                return response.data.data['info'];
            })
            .then(function (data) {
                vm.books = data
            })
    },
    methods: {
        borrow: function (book_id, user_id) {
            const params = new URLSearchParams();
            params.append('book_id', book_id);
            params.append('user_id', user_id);
            axios.post("http://zedd.cc/?s=User.borrowBook", params, config)
            .then(response => {
                if(response.data.data['status'] == true){
                    alert("成功借阅");
                }
            })
            .then(function(){
                location.reload();
            })

        }
    }
})

new Vue({
    el: '#my_table',
    data: {
        books: []
    },
    created: function () {
        const params = new URLSearchParams();
        params.append('user_id', userId);
        var vm = this;
        axios.post("http://zedd.cc/?s=Log.GetById", params, config)
            .then(response => {
                return response.data.data['info'];
            })
            .then(function (data) {
                console.log(data);
                vm.books = data
            })
    },
    methods: {
        returnBook: function (log_id, book_id, user_id) {
            const params = new URLSearchParams();
            params.append('log_id', log_id);
            params.append('user_id', user_id);
            params.append('book_id', book_id);
            axios.post("http://zedd.cc/?s=User.returnBook", params, config)
            .then(response => {
                console.log(response);
                if(response.data.data['status'] == true){
                    alert("成功归还");
                }
                else
                    alert("归还失败");
            })
            .then(function(){
                location.reload();
            })
            
        }
    }
})

new Vue({
    el: '#book_rank',
    data: {
        books: []
    },
    created: function () {
        var vm = this;
        axios.get("http://zedd.cc/?s=Book.getBookOrder")
            .then(response => {
                // console.log(response.data.data['info']);
                return response.data.data['info'];
            })
            .then(function (data) {
                vm.books = data
            })
    }
})

new Vue({
    el: '#data_section',
    data: {
        user_sum: 0,
        sum: 0,
        lent_sum: 0,
        all_cost: 0,

    },
    created: function () {
        var vm = this;
        axios.get("http://zedd.cc/?s=Book.getBookSum")
            .then(response => {
                // console.log(response.data.data['info']);
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.sum = data
            })
        axios.get("http://zedd.cc/?s=Book.getBookLentSum")
            .then(response => {
                // console.log(response.data.data['info']);
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.lent_sum = data
            })
        axios.get("http://zedd.cc/?s=Book.getAllBookPrice")
            .then(response => {
                // console.log(response.data.data['info']);
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.all_cost = data
            })

        axios.get("http://zedd.cc/?s=User.getUserSum")
            .then(response => {
                // console.log(response.data.data['info']);
                return response.data.data['sum'];
            })
            .then(function (data) {
                vm.user_sum = data
            })
        // http://zedd.cc/?s=User.getUserSum
    }
})