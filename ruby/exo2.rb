nombre = 0
while nombre != 34
    puts "Devinez le nombre cache :"
    nombre = gets.chomp
    if nombre.to_i < 34
      puts "le nombre #{nombre} est trop petit"
    elsif nombre.to_i > 34
      puts "le nombre #{nombre} est trop grand"
    else
      puts "bravo c est le bon nombre !"
      nombre = 34
    end
end
