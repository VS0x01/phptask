<div id="app" class="group">
  <div>
   <button class="switcher" onclick="prev()" disabled><</button>
   <button class="switcher" onclick="next()">></button>
  </div>
  <?php require_once 'estimates/show_view.php'; ?>
</div>


<script>
  var table = document.querySelector("#app table");
  var stud_st = document.getElementsByClassName('student_status')[0];
  var dataArr = [];

  var counter = 0;
  var switchers = document.getElementsByClassName('switcher');

  function prev() {
    if (counter>0) {
     counter--;
     if(!counter) switchers[0].disabled = true;
     reloadData();
    }
  }

  function next() {
    if (counter < dataArr.length-1) {
      counter++;
      reloadData();
      switchers[0].disabled = false;
    }
  }

  function getOffset() {
    return counter - counter % 20;
  }

  addEventListener("update", e => {
    updateData().then(() => {
      updateTable();
    });
  });
  
  var updateData = async (offset = 0) => {
    var res = await getData(offset);
    console.log(res);
    dataArr = res;
    counter = offset + dataArr.findIndex(e => e.student_id == document.getElementById('student_id').value);
  }

  updateData();

  function updateTable() { 
    table.innerHTML = generateTable();
    changeStudentStatus();
  }

  function changeStudentStatus() {
    if (stud_st) {
      var $student_status = "OK!";
      var $class = '';
      var $student = dataArr[counter%20];
      if ($student['min_value']>89) {
        $student_status = "Відмінник";
        $class="excellent";
      } else {
        if ($student['max_value']>60 && $student['min_value']<60) {
          $student_status = "Ризик відрахування";
          $class = "risk";
        } else if ($student['max_value']<60) {
          $class = "deduct";
          $student_status = "Відрахувати !";
        }
      }
      stud_st.className = 'student_status ' + $class;
      stud_st.value = $student_status;
    }
  }

  function generateTable() {
    var student = {...dataArr[counter%20]};
    console.log('DATA ARR IN generate: ', dataArr);
    var $res = '<thead><tr><th>';
    $res += 'Студент:';
    $res += '</th>';
    $res += '<th>';
    $res += student.surname;
    $res += '</th></tr></thead>';
    var estimates = JSON.parse(student.estimates); 
    console.log(estimates);
    $res += '<tbody>';
    for (var row of estimates) {
      $res += '<tr>';
      $res += '<td>'+row['f2'];
      $res += '</td><td>';
      $res += row['f3']+'</td>';
      $res += '</tr>';
    }
    $res += '</tbody>';
    return $res;
  }

  function reloadData() {
    console.log('reload');
    if (counter >= 20) updateData(getOffset());
    updateTable();
  }

  async function getData(offset) { 
    var res = await fetch('/phptask/estimates/?action=getAll&offset='+offset+'&json');
    if (res.ok) return await res.json();
    console.log("Error: ", res.status);
    return false;
  }
</script>

<?php if (isset($_GET['add'])) require 'estimates'.DS.'add_view.php' ?>
