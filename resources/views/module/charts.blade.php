<!--    -->
<div class="container-fluid" >
    <div class="row"  id="map_show">
        <div class="col-md-8 col-md-offset-2">
            <div class=" ">
                <hr>
            </div>
            <div class="row">
                <div class="col-md-6" id="duty_map" style="height: 300px;"></div>
                <div class="col-md-6" id="duty_circle_map" style="height: 300px;"></div>
            </div>
            <div class="row">
                <div class="col-md-12" id="step_map" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.1.0/echarts.js"></script>
    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var duty_map = echarts.init(document.getElementById('duty_map'));
        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '职务占比'
            },
            tooltip: {},
            legend: {
                data: ['工时']
            },
            xAxis: {
                data: [@foreach($duty_result['duties'] as $value)
                    "{{$value}}",
                    @endforeach]
            },
            yAxis: {},
            series: [{
                name: '工时',
                type: 'bar',
                stack: '总量',
                data: [@foreach($duty_result['times'] as $value)
                    "{{$value['count']}}",
                    @endforeach]
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        duty_map.setOption(option);
        //====================阶段图========================
        var step_map = echarts.init(document.getElementById('step_map'));
        //
        var option = {
            color: ['#3398DB'],
            title: {
                text: '阶段占比'
            },
            tooltip: {},
            legend: {
                data: ['阶段'],

            },
            xAxis: {
                data: [@foreach($step_result['steps'] as $value)
                    "{!!$value!!}",
                    @endforeach]
            },
            yAxis: {},
            series: [{
                name: '阶段',
                type: 'bar',
                stack: '总量',
                data: [@foreach($step_result['times'] as $item)
                 "{{$item['count']}}",
                    @endforeach]
            }],
        };
        // 使用刚指定的配置项和数据显示图表。
        step_map.setOption(option);
        //=================== 职务饼图 ====================
        var duty_circle_map = echarts.init(document.getElementById('duty_circle_map'));
        //
        option = {
            title : {
                text: '职务占比饼图',
                subtext: '{{$project->name}}',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: [@foreach($duty_result['duties'] as $value)
                    "{{$value}}",
                    @endforeach]
            },
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data: [@foreach($duty_result['times'] as $value)
                    {value:"{{$value['count']}}",name:"{{$value['name']}}"},
                        @endforeach],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        // 使用刚指定的配置项和数据显示图表。
        duty_circle_map.setOption(option);
    </script>
@endpush