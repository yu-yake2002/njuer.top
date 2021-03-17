answer = Array("A", "B", "C", "D", "E");
function choose_ans(qid, ans) {
    document.getElementById("answer_input_" + qid.toString()).value = ans;
    ans += 2;
    document.getElementById("answer_" + qid.toString()).innerHTML = answer[ans];
}