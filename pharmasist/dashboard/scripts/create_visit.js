//! FUNCTION TO REMOVE AND ADD ROW 

function removeAddRows(addBtnName,input_tableName,row_html,allInputRowClassName){
addBtnName.addEventListener("click",()=>{
    input_tableName.innerHTML+=row_html;
    complain_input_rows = document.querySelectorAll(`.${allInputRowClassName}`);

complain_input_rows.forEach((row)=>{
        const dltBtn = row.querySelector(".fa-xmark");
    dltBtn.addEventListener("click",()=>{
        if(complain_input_rows.length>2){
            row.remove();
        }
    })
});
});
}

// !COMPLAIN TABLE ROW
const add_Complain_row_btn = document.getElementById("add_Complain_row"),
complain_input_table=document.querySelector(".complain_input_table")

const complain_row_html = `<tr class="flex tbl_input_row complain_input_row">
                        <td><input type="text" name="complain-0-[]" id="complain-0"></td>
                        <td><input type="text" name="frequency-0-[]" id="frequency-0"></td>
                        <td><input type="text" name="severity-0-[]" id="severity-0"></td>
                        <td><input type="text" name="duration-0-[]" id="duration-0"></td>
                        <td><i class="fa-solid fa-xmark" style="color: #8b0404;"></i></td>
                    </tr>`;

        removeAddRows(add_Complain_row_btn,complain_input_table,complain_row_html,"complain_input_row");
    
        // !ADD add_Diagnosis_row

        const add_Diagnosis_row_btn = document.getElementById("add_Diagnosis_row"),
        Diagnosis_input_table = document.querySelector(".Diagnosis_input_table");
        const Diagnosis_row_html = `
                            <tr class="flex tbl_input_row Diagnosis_input_row">
                                <td><input type="text" name="complain-0-[]" id="complain-0"></td>
                                <td><input type="text" name="frequency-0-[]" id="frequency-0"></td>
                                <td><i class="fa-solid fa-xmark" style="color: #8b0404;"></i></td>
                            </tr>`;

removeAddRows(add_Diagnosis_row_btn,Diagnosis_input_table,Diagnosis_row_html,"Diagnosis_input_row");

// !ADD MEDICINES_row

const add_rx_row_btn = document.getElementById("add_rx_row"),
rx_input_table = document.querySelector(".rx_input_table");

const rx_row_html = `
                            <tr class="flex tbl_input_row rx_input_row">
                                <td><input type="text" name="Medicine-0-[]" id="Medicine-0"></td>
                                <td><input type="text" name="Dose-0-[]" id="Dose-0"></td>
                                <td><input type="text" name="When-0-[]" id="When-0"></td>
                                <td><input type="text" name="Frequency-0-[]" id="Frequency-0"></td>
                                <td><input type="text" name="Qty-0-[]" id="Qty-0"></td>
                                <td><i class="fa-solid fa-xmark" style="color: #8b0404;"></i></td>
                            </tr>
`
removeAddRows(add_rx_row_btn,rx_input_table,rx_row_html,"rx_input_row");

