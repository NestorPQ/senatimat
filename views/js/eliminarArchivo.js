const fs = require('fs');
const archivo = process.argv[2];

fs.unlink(archivo, (err) => {
  if (err) throw err;
  console.log(`El archivo ${archivo} ha sido eliminado exitosamente.`);
});
