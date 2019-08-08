<template>
    <div>
        <div class="panel">
            <div class="panel-heading">Calendar</div>
            <div class="panel-body">
                <div class="col-md-4">
                    <form @submit.prevent="addEvent">
                        <label for="eventname">Event</label>
                        <input type="text" class="form-control" id="eventname" name="eventname" v-model="event.eventname">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-6">
                                <label for="datefrom">From</label>
                                <input type="date" class="form-control" id="datefrom" name="datefrom" v-model="event.datefrom">
                            </div>
                            <div class="col-md-6">
                                <label for="dateto">To</label>
                                <input type="date" class="form-control" id="dateto" name="dateto" v-model="event.dateto">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-12">
                                <input type="checkbox" style="margin-right: 3px;" v-model="event.mon">Mon
                                <input type="checkbox" style="margin-right: 3px;" v-model="event.tue">Tue
                                <input type="checkbox" style="margin-right: 3px;" v-model="event.wed">Wed
                                <input type="checkbox" style="margin-right: 3px;" v-model="event.thu">Thu
                                <input type="checkbox" style="margin-right: 3px;" v-model="event.fri">Fri
                                <input type="checkbox" style="margin-right: 3px;" v-model="event.sat">Sat
                                <input type="checkbox" style="margin-right: 3px;" v-model="event.sun">Sun
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <h4>{{ eventdate }}</h4>
                    </div>
                    <div class="row">
                        <table class="table">
                            <tbody>
                                <tr v-for="day in days">
                                <td v-bind:class="{ success: (event.sun == 1 && day.includes('sun')) || (event.mon == 1 && day.includes('mon')) || (event.tue == 1 && day.includes('tue')) || (event.wed == 1 && day.includes('wed')) || (event.thu == 1 && day.includes('thu')) || (event.fri == 1 && day.includes('fri')) || (event.fri == 1 && day.includes('fri')) }">{{ day }}</td>
                                    <td v-for="event in events" v-bind:class="{ success: (event.sun == 1 && day.includes('sun')) || (event.mon == 1 && day.includes('mon')) || (event.tue == 1 && day.includes('tue')) || (event.wed == 1 && day.includes('wed')) || (event.thu == 1 && day.includes('thu')) || (event.fri == 1 && day.includes('fri')) || (event.fri == 1 && day.includes('fri')) }">
                                        
                                        <label v-if="event.sun == 1 && day.includes('sun')" v-bind:class="{success: event.sun == 1 && day.includes('sun')}">{{event.eventname}}</label>
                                        <label v-if="event.mon == 1 && day.includes('mon')" v-bind:class="{success: event.mon == 1 && day.includes('mon')}">{{event.eventname}}</label>
                                        <label v-if="event.tue == 1 && day.includes('tue')" v-bind:class="{success: event.tue == 1 && day.includes('tue')}">{{event.eventname}}</label>
                                        <label v-if="event.wed == 1 && day.includes('wed')" v-bind:class="{success: event.wed == 1 && day.includes('wed')}">{{event.eventname}}</label>
                                        <label v-if="event.thu == 1 && day.includes('thu')" v-bind:class="{success: event.thu == 1 && day.includes('thu')}">{{event.eventname}}</label>
                                        <label v-if="event.fri == 1 && day.includes('fri')" v-bind:class="{success: event.fri == 1 && day.includes('fri')}">{{event.eventname}}</label>
                                        <label v-if="event.sat == 1 && day.includes('sat')" v-bind:class="{success: event.sat == 1 && day.includes('sat')}">{{event.eventname}}</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        data() {
            return {
                eventdate: '',
                eventmonths: [
                    'January', 
                    'February', 
                    'March', 
                    'April', 
                    'May', 
                    'June',
                    'July', 
                    'August', 
                    'September', 
                    'October', 
                    'November', 
                    'December'
                ],
                days: [],
                events: [],
                event: {
                    id: '',
                    eventname: '',
                    datefrom: '',
                    dateto: '',
                    sun: '',
                    mon: '',
                    tue: '',
                    wed: '',
                    thu: '',
                    fri: '',
                    sat: ''
                }, 
                event_id: '',
                pagination: {},
                edit: false
            }
        },

        created() {
            var date = new Date();
            // this.fetchEvents();
            this.getDays(date.getFullYear(), date.getMonth());
            this.eventdate = `${this.eventmonths[date.getMonth()]} ${date.getFullYear()}`;
        },
        methods: {
            fetchEvents() {
                axios({method: 'GET', url: '/api/events'})
                .then(res => {
                    console.log(res.data.data);
                    this.events = res.data.data;
                }, error => {
                    console.error(error);
                })
            },
            addEvent() {
                axios.post('/api/event', {
                    eventname: this.event.eventname,
                    datefrom: this.event.datefrom,
                    dateto: this.event.dateto,
                    sun: this.event.sun ? '1':'0',
                    mon: this.event.mon ? '1':'0',
                    tue: this.event.tue ? '1':'0',
                    wed: this.event.wed ? '1':'0',
                    thu: this.event.thu ? '1':'0',
                    fri: this.event.fri ? '1':'0',
                    sat: this.event.sat ? '1':'0'
                    })
                    .then(res => {
                        this.eventname = '';
                        this.datefrom = '';
                        this.dateto = '';
                        this.sun = '';
                        this.mon = '';
                        this.tue = '';
                        this.wed = '';
                        this.thu = '';
                        this.fri = '';
                        this.sat = '';
                        this.fetchEvents();
                        this.$notification.success("Event successfully added.", {  timer: 10 });
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getDays(year, month) {
                var names = [ 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat' ];
                var date = new Date(year, month - 1, 1);
                var result = [];
                while (date.getMonth() == month - 1) {
                    result.push(date.getDate() + "-" + names[date.getDay()]);
                    date.setDate(date.getDate() + 1);
                }
                this.days = result;
            }
        }
    }
</script>