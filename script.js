const formTambah = document.querySelector('#form-tambah');
const catatan = document.querySelector('#catatan');
const totalPemasukan = document.querySelector('#total-pemasukan');
const totalPengeluaran = document.querySelector('#total-pengeluaran');
const totalSaldo = document.querySelector('#total-saldo');
const exportBtn = document.querySelector('#export');

let pemasukan = 0;
let pengeluaran = 0;

formTambah.addEventListener('submit', (event) => {
  event.preventDefault();
  
  const tanggal = document.querySelector('#tanggal').value;
  const keterangan = document.querySelector('#keterangan').value;
  const jumlah = parseInt(document.querySelector('#jumlah').value);
  const jenis = document.querySelector('#jenis').value;

  let jenisText;
  let jumlahText;
  
  if (jenis === 'pemasukan') {
    pemasukan += jumlah;
    jenisText = 'Pemasukan';
    jumlahText = `Rp ${jumlah.toLocaleString()}`;
  } else {
    pengeluaran += jumlah;
    jenisText = 'Pengeluaran';
    jumlahText = `Rp (${jumlah.toLocaleString()})`;
  }

  const newRow = `
    <tr>
      <td>${tanggal}</td>
      <td>${jenisText}</td>
      <td>${keterangan}</td>
      <td>${jumlahText}</td>
    </tr>
  `;
  
  catatan.insertAdjacentHTML('beforeend', newRow);
  
  totalPemasukan.textContent = `Rp ${pemasukan.toLocaleString()}`;
  totalPengeluaran.textContent = `Rp (${pengeluaran.toLocaleString()})`;
  totalSaldo.textContent = `Rp ${(pemasukan - pengeluaran).toLocaleString()}`;

  formTambah.reset();
});

exportBtn.addEventListener('click', () => {
  const table = document.querySelector('table');

  // Create a new Workbook object
  const workbook = XLSX.utils.book_new();

  // Convert the table to a worksheet
  const worksheet = XLSX.utils.table_to_sheet(table);

  // Add the worksheet to the workbook
  XLSX.utils.book_append_sheet(workbook, worksheet, 'Catatan Keuangan');

  // Save the workbook as an Excel file
  const filename = 'catatan_keuangan.xlsx';
  XLSX.writeFile(workbook, filename);
});
