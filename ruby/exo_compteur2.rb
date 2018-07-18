text = "Les classements peuvent être spécifiés aux niveaux des serveurs, des bases de données, des colonnes, des expressions et des identificateurs. Lorsque vous installez une instance de SQL Server, vous spécifiez le classement par défaut du serveur pour cette instance. Chaque fois que vous créez une base de données, vous pouvez spécifier le classement par défaut utilisé pour la base de données. Si vous ne spécifiez pas de classement, le classement par défaut de l'instance du serveur sera utilisé par défaut pour la base de données."

frequence = Hash.new(1)
mots = text

mots.each do |mot|
  frequence = frequence + 1
end
