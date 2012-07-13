var colony[10][10];

function initialize()
	{
		for(y=0;y<10;y++)
			{
					for(x=0;x<10;x++)
						{
							colony[y][x]=0;
						}
			}
	}

function setlife(x,y)
	{
		colony[y][x]=1;
	}

function survive(x,y)
	{
		neighbours=0;
		if(colony[y][(x+1)%10]==1)
			neighbours++;
		if(colony[y][Math.abs(x-1)]==1)
			neighbours++;
		if(colony[(y+1)%10][x]==1)
			neighbours++;
		if(colony[(Math.abs(y-1))][x]==1)
			neighbours++;
		if(colony[Math.abs(y-1)][Math.abs(x-1)]==1)
			neighbours++;
		if(colony[Math.abs(y-1)][(x+1)%10]==1)
			neighbours++;
		if(colony[(y+1)%10][Math.abs(x-1)]==1)
			neighbours++;
		if(colony[(y+1)%10][(x+1)%10]==1)
			neighbours++;
		if(colony[y][x]==1&&(neighbours==0||neighbours==1||neighbours==4))
			{
				colony[y][x]=0;
				return;
			}
			
		if(colony[y][x]==1&&(neighbours==2||neighbours==3))
			{
				colony[y][x]=1;
				return;
			}
		if(colony[y][x]==0&&(neighbours==3))
			{
				colony[y][x]live=1;	
				return;
			}
	}