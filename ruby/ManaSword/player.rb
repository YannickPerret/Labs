class  Player # Propriété de la class du joueur
  def initialize(x, y, window)
    @x, @y = x, y
    @image = Gosu::Image.new(window, "images/player.png")
  end
  def draw
    @image.draw(@x, @y, 1)
  end
  def move_left
    @x -= 2
  end
  def move_right
    @x += 2
  end
  def move_up
    @y -= 2
  end
  def move_down
    @y += 2
  end
  def escape
    close
  end
end
