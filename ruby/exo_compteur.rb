text ="Les classements peuvent être spécifiés aux niveaux des serveurs, des bases de données, des colonnes, des expressions et des identificateurs. Lorsque vous installez une instance de SQL Server, vous spécifiez le classement par défaut du serveur pour cette instance. Chaque fois que vous créez une base de données, vous pouvez spécifier le classement par défaut utilisé pour la base de données. Si vous ne spécifiez pas de classement, le classement par défaut de l'instance du serveur sera utilisé par défaut pour la base de données.".downcase

frequence = Hash.new{0}
mots = text.tr('.,":', '').split(' ')

 mots.each do |mot|
  if frequence[mot]
    frequence[mot] += 1
  end
  frequence.sort_by do {|mot. count|count}
end
frequence.each do |mot, count|
  puts "le mot \"#{mot}\" apparait #{count} fois"
end
