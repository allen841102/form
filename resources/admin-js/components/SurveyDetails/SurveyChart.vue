<template>
    <div class="result-table">
        <el-row :key="index" v-for="(table, index) in tableData">
            <el-col :span="16">
                <el-tag :class="Question.getClassName(table.type_id)" class="margin-bot" type="warning">
                    {{ Question.getTypeName(table.type_id)}}
                </el-tag>
                <span> {{ index+1 }}. {{ table.title }}</span>
                <el-table :data="table.answers"
                          border
                          style="width: 100%"
                          v-if="table.type_id !== 3">
                    <el-table-column
                            label="答案選項"
                            prop="option"
                            width="auto">
                    </el-table-column>
                    <el-table-column
                            label="填答次數"
                            prop="count"
                            width="100">
                    </el-table-column>
                    <el-table-column
                            label="百分比"
                            prop="ratio"
                            width="100">
                    </el-table-column>
                </el-table>
                <div v-if="table.type_id ==3" class="answer-area">
                    <div>
                       <div :key="index"
                             v-for="(answer, index) in table.answers">
                            {{ answer.option }} ( {{answer.count}} )
                       </div>
                    </div>
                </div>
            </el-col>
            <el-col :span="8">
                <span class="question-hint"> 填答人數 20 / 30 </span>
            </el-col>
        </el-row>

        <el-divider></el-divider>
    </div>
</template>
<script>
    import questionLib from '../../lib/question';

    export default {
        data() {
            return {
                Question: questionLib,
                tableData: [
                    {
                        title: '請問你的學院',
                        type_id: 1,
                        answers: [
                            {
                                option: '文學院',
                                count: '23',
                                ratio: '38.2%'
                            },
                            {
                                option: '理學院',
                                count: '73',
                                ratio: '61.8%'
                            },
                        ]
                    },
                    {
                        title: '請問你的專長',
                        type_id: 2,
                        answers: [
                            {
                                option: '吃飯',
                                count: '12',
                                ratio: '38.2%'
                            },
                            {
                                option: '睡覺',
                                count: '20',
                                ratio: '61.8%'
                            },
                            {
                                option: '上網',
                                count: '20',
                                ratio: '61.8%'
                            },
                        ]
                    },
                    {
                        title: '留下任何建議',
                        type_id: 3,
                        answers: [
                            {
                                option: '不知道',
                                count: '12',
                            },
                            {
                                option: '看電視',
                                count: '20',
                            },
                            {
                                option: '打桌球',
                                count: '20',
                            },
                        ]
                    }
                ]
            }
        }
    }
</script>
<style>
    .result-table {
        margin-top: 10px;
    }
    .question-hint {
        font-size: 12px;
        color: lightslategray;
        display: table;
        margin-left: auto;
        margin-right: 0;
    }
    .answer-area {
        overflow-y: auto;
        border: 1px dotted #d2d2d2;
        padding: 10px;
        font-size: 0.8em;
        max-height: 200px
    }
</style>
