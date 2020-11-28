<form onsubmit="estimateStudent(event)" id="add_form" class="add">
  <label for="student_id">Студент</label>
  <select id="student_id" name="student_id" onchange="anotherOptionSelected(this)">
  <?php foreach ($students as $key => $value): ?>
    <option value="<?=$value['student_id']?>">
      <?=$value['name']?> <?=$value['surname']?>
    </option>
  <?php endforeach; ?>
  <option value="new">
    Новий...
  </option>
  </select>
  <input class="opt" name="name" type="text" placeholder="Ім`я" hidden>
  <input class="opt" name="surname" type="text" placeholder="Прізвище" hidden>
  <b>Оцінки з дисципліни:</b>
  <?php foreach ($estimates as $value): ?>
    <label for="<?=$value->f1;?>"><span><?=$value->f2;?></span></label>
    <input id="<?=$value->f1;?>" name="<?=$value->f1;?>" type="number" min="0" max="100" placeholder="Бал (0-100)" required>
  <?php endforeach; ?>
  <button type="submit">Додати</button>
</form>

<script>
  var newStudent = false;
  var ns = document.querySelectorAll("#add_form .opt");
  var selectedStudent = document.getElementById('student_id');

  async function estimateStudent(e) {
    e.preventDefault();
    var data = {};
    if(newStudent) {
      data = {
        name: ns[0].value,
        surname: ns[1].value
      }
      await fetch('/phptask/students', {
        method: 'POST',
        headers: {
          'Content-type': 'application/json'
        },
        body: JSON.stringify(data)
      }).then(async res => {
        var option = document.createElement("option");
        option.text = data.name + " "  + data.surname;
        option.value = await res.json();
        selectedStudent.add(option, selectedStudent.selectedIndex);
        selectedStudent.selectedIndex--;
      }).catch(e => {
        console.log(e);
        return;
      });
    }
    var inputs = document.querySelectorAll('#add_form input');
    data = {
      student_id: selectedStudent.value,
      estimates: {}
    };
    inputs.forEach(el => {
      if(!el.classList.contains("opt")) data.estimates[el.name] = el.value;
    });
    console.log(inputs, data);
    fetch('/phptask/estimates', {
      method: 'POST',
      headers: {
        'Content-type': 'application/json'
      },
      body: JSON.stringify(data)
    }).then(async res => {
      var res = await res.text();
      console.log(res);
      dispatchEvent(new Event("update"));
    }).catch(err => {
      console.log(err.status);
    })
  }

  function anotherOptionSelected(s) {
    newStudent = (s.value == "new");
    ns.forEach(e => e.hidden = !newStudent);
  }
</script>
