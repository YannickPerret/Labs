nombre = 0
resolu = 0
for num in 1..3
  next if nombre == 3
  puts "insérer un nombre : "
  nombre = gets.chomp
  if nombre.to_i < 3
    puts "Votre chiffre est trop petit"
  elsif nombre.to_i > 3
    puts "Votre chiffre est trop grand"
  else
    puts "vous avez trouver le nombre"
    resolu = 1
  end
end
