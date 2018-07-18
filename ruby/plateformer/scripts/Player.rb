class Player

def initialize(x,y)
  @real_x = x
  @real_y = y
  @sprite = Image.new($window, “graphics/sprites/player_1_stand_right.png”, false)
  @x = @real_x + (@sprite.width / 2)
  @y = @real_y + @sprite.height
end

def update
  @real_x = @x – (@spirte.width / 2)
  @real_y = @y – @sprite.height
end

def draw(z=5)
@sprite.draw(@x, @y, z)
end

end
